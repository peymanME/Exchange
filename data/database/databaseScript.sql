-- -----------------------------------------------------
-- Schema db_exchange
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_exchange` DEFAULT CHARACTER SET utf8 ;
USE `db_exchange` ;

-- -----------------------------------------------------
-- Table `db_exchange`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`Users` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(32) NOT NULL,
  `FirstName` VARCHAR(45) NULL,
  `LastName` VARCHAR(45) NULL,
  `Parent` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC),
  INDEX `Users_Children_id_idx` (`Parent` ASC),
  CONSTRAINT `Users_Parent_id`
    FOREIGN KEY (`Parent`)
    REFERENCES `db_exchange`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exchange`.`CurrenciesName`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`CurrenciesName` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`CurrenciesName` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Code` NCHAR(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Code_UNIQUE` (`Code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exchange`.`CurrenciesPrice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`CurrenciesPrice` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`CurrenciesPrice` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `PurchasePrice` DECIMAL(15,2) NOT NULL,
  `SellPrice` DECIMAL(15,2) NOT NULL,
  `AveragePrice` DECIMAL(15,2) NOT NULL,
  `DateRegister` DATETIME NOT NULL,
  `CurrenciesName_id` INT NOT NULL,
  `Unit` INT NOT NULL,
  `Codel` VARCHAR(3) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `CurrenciesPrice_CurrenciesName_Code_idx` (`CurrenciesName_id` ASC),
  CONSTRAINT `CurrenciesPrice_CurrenciesName_Code`
    FOREIGN KEY (`CurrenciesName_id`)
    REFERENCES `db_exchange`.`CurrenciesName` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exchange`.`CurrenciesName_Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`CurrenciesName_Users` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`CurrenciesName_Users` (
  `Users_id` INT NOT NULL,
  `CurrenciesName_id` INT NOT NULL,
  UNIQUE INDEX `index3` (`CurrenciesName_id` ASC, `Users_id` ASC),
  CONSTRAINT `MyCurrencies_Users_id`
    FOREIGN KEY (`Users_id`)
    REFERENCES `db_exchange`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `MyCurrencies_CurrenciesName_id`
    FOREIGN KEY (`CurrenciesName_id`)
    REFERENCES `db_exchange`.`CurrenciesName` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exchange`.`LogsSales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`LogsSales` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`LogsSales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Sell` TINYINT NOT NULL,
  `Amount` DECIMAL(15,2) NOT NULL,
  `DateRegister` DATETIME NOT NULL,
  `Worth` DECIMAL(15,2) NOT NULL,
  `CurrenciesName_id` INT NOT NULL,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `LogsSales_CurrenciesName_id_idx` (`CurrenciesName_id` ASC),
  INDEX `LogsSales_Users_id_idx` (`Users_id` ASC),
  CONSTRAINT `LogsSales_CurrenciesName_id`
    FOREIGN KEY (`CurrenciesName_id`)
    REFERENCES `db_exchange`.`CurrenciesName` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LogsSales_Users_id`
    FOREIGN KEY (`Users_id`)
    REFERENCES `db_exchange`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exchange`.`Wallet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exchange`.`Wallet` ;

CREATE TABLE IF NOT EXISTS `db_exchange`.`Wallet` (
  `id` INT NOT NULL,
  `Cash` DECIMAL(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `Wallet_Users_id`
    FOREIGN KEY (`id`)
    REFERENCES `db_exchange`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Data for table `db_exchange`.`Users`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_exchange`;
INSERT INTO `db_exchange`.`Users` (`id`, `Email`, `Password`, `FirstName`, `LastName`, `Parent`) VALUES (DEFAULT, 'peymanmostafaie@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'peyman', 'mostafai ekhtiar', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_exchange`.`CurrenciesName`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_exchange`;
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'US Dollar', 'USD');
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'Euro', 'EUR');
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'Swiss Franc', 'CHF');
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'Russian ruble', 'RUB');
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'Czech koruna', 'CZK');
INSERT INTO `db_exchange`.`CurrenciesName` (`id`, `Name`, `Code`) VALUES (DEFAULT, 'Pound sterling', 'GBP');

COMMIT;