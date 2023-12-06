-- MySQL Script generated by MySQL Workbench
-- Tue Dec  5 18:24:18 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema expenses-app
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema expenses-app
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `expenses-app` DEFAULT CHARACTER SET utf8 ;
USE `expenses-app` ;

-- -----------------------------------------------------
-- Table `expenses-app`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`users` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`money_boxes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`money_boxes` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `currency_code` VARCHAR(3) NOT NULL DEFAULT 'USD',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`expense_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`expense_groups` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `group_key` VARCHAR(40) NOT NULL,
  `moneybox_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `group_key_UNIQUE` (`group_key` ASC) VISIBLE,
  INDEX `fk_expense_group_moneyboxes1_idx` (`moneybox_id` ASC) VISIBLE,
  CONSTRAINT `fk_expense_group_moneyboxes1`
    FOREIGN KEY (`moneybox_id`)
    REFERENCES `expenses-app`.`money_boxes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`expense_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`expense_categories` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `expensegroup_id` INT NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `parentcategory_id` BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expense_group_category_expense_group1_idx` (`expensegroup_id` ASC) VISIBLE,
  INDEX `fk_expense_group_categories_expense_group_categories1_idx` (`parentcategory_id` ASC) VISIBLE,
  CONSTRAINT `fk_expense_group_category_expense_group1`
    FOREIGN KEY (`expensegroup_id`)
    REFERENCES `expenses-app`.`expense_groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_expense_group_categories_expense_group_categories1`
    FOREIGN KEY (`parentcategory_id`)
    REFERENCES `expenses-app`.`expense_categories` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`expenses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`expenses` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `date` TIMESTAMP NOT NULL,
  `transaction_type` ENUM("IN", "OUT", "NONE") NOT NULL DEFAULT 'NONE',
  `value` BIGINT(20) NOT NULL,
  `expensegroup_id` BIGINT(20) NOT NULL,
  `expensecategory_id` BIGINT(20) NOT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expenses_expense_group_category1_idx` (`expensecategory_id` ASC) VISIBLE,
  INDEX `fk_expenses_expense_group1_idx` (`expensegroup_id` ASC) VISIBLE,
  CONSTRAINT `fk_expenses_expense_group_category1`
    FOREIGN KEY (`expensecategory_id`)
    REFERENCES `expenses-app`.`expense_categories` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_expenses_expense_group1`
    FOREIGN KEY (`expensegroup_id`)
    REFERENCES `expenses-app`.`expense_groups` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`scheduled_expenses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`scheduled_expenses` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `transaction_type` ENUM("IN", "OUT", "NONE") NOT NULL DEFAULT 'NONE',
  `value` BIGINT(20) NOT NULL,
  `frequency_type` ENUM("DAILY", "MONTHLY", "YEARLY") NOT NULL DEFAULT 'MONTHLY',
  `frequency` INT NOT NULL DEFAULT 1,
  `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` TIMESTAMP NULL DEFAULT NULL,
  `expensegroup_id` INT NOT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_scheduled_transactions_expense_group1_idx` (`expensegroup_id` ASC) VISIBLE,
  CONSTRAINT `fk_scheduled_transactions_expense_group1`
    FOREIGN KEY (`expensegroup_id`)
    REFERENCES `expenses-app`.`expense_groups` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`transactions` (
  `id` BIGINT(20) NOT NULL,
  `scheduledexpense_id` BIGINT(20) NULL DEFAULT NULL,
  `expense_id` BIGINT(20) NULL DEFAULT NULL,
  `canceled` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_auto_transactions_scheduled_transactions1_idx` (`scheduledexpense_id` ASC) VISIBLE,
  INDEX `fk_transactions_expenses1_idx` (`expense_id` ASC) VISIBLE,
  CONSTRAINT `fk_auto_transactions_scheduled_transactions1`
    FOREIGN KEY (`scheduledexpense_id`)
    REFERENCES `expenses-app`.`scheduled_expenses` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transactions_expenses1`
    FOREIGN KEY (`expense_id`)
    REFERENCES `expenses-app`.`expenses` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expenses-app`.`expense_group_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `expenses-app`.`expense_group_users` (
  `id` BIGINT(20) NOT NULL,
  `user_id` BIGINT(20) NULL,
  `expensegroup_id` BIGINT(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expense_group_users_users1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_expense_group_users_expense_groups1_idx` (`expensegroup_id` ASC) INVISIBLE,
  CONSTRAINT `fk_expense_group_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `expenses-app`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_expense_group_users_expense_groups1`
    FOREIGN KEY (`expensegroup_id`)
    REFERENCES `expenses-app`.`expense_groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
