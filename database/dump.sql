-- Create Database
CREATE SCHEMA `dev_vagas` ;

-- Create Table Vagas
CREATE TABLE `dev_vagas`.`vagas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `ativo` ENUM('y', 'n') NOT NULL, -- Change for CHAR if not work!
  `data` TIMESTAMP NOT NULL DEFAULT now(),
  PRIMARY KEY (`id`));
