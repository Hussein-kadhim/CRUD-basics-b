-- database
-- ----------------------------------------------------------------------

-- Stap : 01
-- Doel : Maak een nieuwe database aan: Rollercoaster_2509b
-- ----------------------------------------------------------------------
-- Versie Datum Autuer Omschrijving
-- ----------------------------------------------------------------------
-- -- 01 04-12-2025 Hussein Kadhim Database met de hoogste
-- -- achtbanen van Europa
-- ----------------------------------------------------------------------

-- Verwijder database Rollercoaster_2509b
DROP DATABASE IF EXISTS Rollercoaster_2509b;

-- Maak de database Rollercoaster_2509b
CREATE DATABASE Rollercoaster_2509b;

-- Gebruik de database Rollercoaster_2509b
USE Rollercoaster_2509b;

-- Stap : 02
-- Doel : Maak een nieuwe tabel aan: Rollercoaster
-- ----------------------------------------------------------------------
-- Versie Datum Autuer Omschrijving
-- ----------------------------------------------------------------------
-- -- 01 04-12-2025 Hussein Kadhim Tabel met de hoogste
-- -- achtbanen van Europa
-- ----------------------------------------------------------------------

-- Maak de tabel Rollercoaster
CREATE TABLE Rollercoaster
(
  Id                   SMALLINT     UNSIGNED    NOT NULL       AUTO_INCREMENT            COMMENT'Primary key of the Rollercoaster table'
  ,Rollercoaster       VARCHAR(50)              NOT NULL                                 COMMENT 'Name of the rollercoaster'
  ,AmusementPark       VARCHAR(50)              NOT NULL                                 COMMENT 'Name of the amusementpark'
  ,Country             VARCHAR(50)              NOT NULL                                 COMMENT 'Country where it is located'
  ,TopSpeed            SMALLINT     UNSIGNED    NOT NULL                                 COMMENT 'Topspeed in km/h'
  ,Height              TINYINT      UNSIGNED    NOT NULL                                 COMMENT 'Height in meters'
  ,YearOfConstruction  DATE                     NOT NULL                                 COMMENT 'Year of construction'
  ,IsActive            BIT                      NOT NULL      DEFAULT 1                  COMMENT 'Indicates whether the rollercoaster is Active(1)'
  ,Remark              VARCHAR(255)             NULL          DEFAULT NULL               COMMENT 'Optional remark or additional information'
  ,DateCreated         DATETIME(6)              NOT NULL      DEFAULT NOW(6)             COMMENT 'Timestamp when the record was created'
  ,DateChanged         DATETIME(6)              NOT NULL      DEFAULT NOW(6)             COMMENT 'Timestamp of the latest update'
  ,CONSTRAINT          PK_Rollercoaster_Id      PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Stap : 03
-- ----------------------------------------------------------------------
-- Doel : Vul de tabel Rollercoaster met data
-- ----------------------------------------------------------------------
-- Versie Datum Autuer Omschrijving
-- ----------------------------------------------------------------------
-- -- 01 04-12-2025 Hussein Kadhim Vul tabel hoogste
-- -- achtbanen van Europa
-- ----------------------------------------------------------------------

-- Vul de tabel
INSERT INTO Rollercoaster
(
  Rollercoaster
  ,AmusementPark
  ,Country
  ,TopSpeed
  ,Height
  ,YearOfConstruction
)
VALUES
   ('Kingda Ka', 'Six Flags Great Adventure', 'Verenigd Koninkrijk', 206, 127, '2005-10-21')
  ,('Red Force', 'Ferrari Land', 'Spanje', 180, 112, '2017-04-07')
  ,('Hyperion', 'Energylandia', 'Polen', 142, 77, '2018-08-14')
  ,('Shambhala', 'PortAventura Park', 'Spanje', 134, 76, '2012-04-07')
  ,('Schwur des Karnen', 'Hansa Park', 'Duitsland', 127, 73, '2017-02-25');