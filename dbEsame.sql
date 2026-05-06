CREATE DATABASE Officina;
USE Officina;

CREATE TABLE CLIENTE (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    Cognome VARCHAR(50) NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Telefono VARCHAR(20)
);

CREATE TABLE `USER` (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(32) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(32) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE,
    isTecnico BOOLEAN DEFAULT FALSE,
    isMagazziniere BOOLEAN DEFAULT FALSE,
    CodiceOTP VARCHAR(32),
    Attivazione BOOLEAN DEFAULT FALSE
);

CREATE TABLE AUTOVEICOLO (
    Targa VARCHAR(15) PRIMARY KEY,
    Ntelaio VARCHAR(50) UNIQUE NOT NULL,
    Descrizione TEXT,
    Annocostruzione YEAR
);

CREATE TABLE TIPO_INTERVENTO (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    Descrizione VARCHAR(100) NOT NULL
);

CREATE TABLE SERVIZIO (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    CostoOrario DECIMAL(10,2) NOT NULL,
    Descrizione TEXT
);

CREATE TABLE ACCESSORIO (
    CodiceArticolo INT AUTO_INCREMENT PRIMARY KEY,
    Descrizione VARCHAR(100) NOT NULL,
    CostoUnitario DECIMAL(10,2) NOT NULL
);

CREATE TABLE PEZZO_DI_RICAMBIO (
    CodicePezzo INT AUTO_INCREMENT PRIMARY KEY,
    Descrizione VARCHAR(100) NOT NULL,
    CostoUnitario DECIMAL(10,2) NOT NULL
);

CREATE TABLE OFFICINA (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    Denominazione VARCHAR(100) NOT NULL,
    Indirizzo VARCHAR(150)
);


CREATE TABLE DIPENDENTE (
    User VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE INTERVENTO (
    Codice INT AUTO_INCREMENT PRIMARY KEY,
    Data DATE NOT NULL,
    CodiceCliente INT,
    TargaAutoveicolo VARCHAR(15),
    CodiceTipoIntervento INT,
    CodiceOfficina INT,
    FOREIGN KEY (CodiceCliente) REFERENCES CLIENTE(Codice),
    FOREIGN KEY (TargaAutoveicolo) REFERENCES AUTOVEICOLO(Targa),
    FOREIGN KEY (CodiceTipoIntervento) REFERENCES TIPO_INTERVENTO(Codice),
    FOREIGN KEY (CodiceOfficina) REFERENCES OFFICINA(Codice)
);

CREATE TABLE OFFRE (
    CodiceOfficina INT,
    CodiceServizio INT,
    PRIMARY KEY (CodiceOfficina, CodiceServizio),
    FOREIGN KEY (CodiceOfficina) REFERENCES OFFICINA(Codice),
    FOREIGN KEY (CodiceServizio) REFERENCES SERVIZIO(Codice)
);

CREATE TABLE PRESENZA_ACCESSORIO (
    CodiceOfficina INT,
    CodiceArticolo INT,
    Quantita INT DEFAULT 0,
    PRIMARY KEY (CodiceOfficina, CodiceArticolo),
    FOREIGN KEY (CodiceOfficina) REFERENCES OFFICINA(Codice),
    FOREIGN KEY (CodiceArticolo) REFERENCES ACCESSORIO(CodiceArticolo)
);

CREATE TABLE PRESENZA_RICAMBIO (
    CodiceOfficina INT,
    CodicePezzo INT,
    Quantita INT DEFAULT 0,
    PRIMARY KEY (CodiceOfficina, CodicePezzo),
    FOREIGN KEY (CodiceOfficina) REFERENCES OFFICINA(Codice),
    FOREIGN KEY (CodicePezzo) REFERENCES PEZZO_DI_RICAMBIO(CodicePezzo)
);

CREATE TABLE COMPRENDE (
    CodiceIntervento INT,
    CodiceServizio INT,
    Ore DECIMAL(5, 2),
    PRIMARY KEY (CodiceIntervento, CodiceServizio),
    FOREIGN KEY (CodiceIntervento) REFERENCES INTERVENTO(Codice),
    FOREIGN KEY (CodiceServizio) REFERENCES SERVIZIO(Codice)
);

CREATE TABLE USA (
    CodiceIntervento INT,
    CodiceArticolo INT,
    PRIMARY KEY (CodiceIntervento, CodiceArticolo),
    FOREIGN KEY (CodiceIntervento) REFERENCES INTERVENTO(Codice),
    FOREIGN KEY (CodiceArticolo) REFERENCES ACCESSORIO(CodiceArticolo)
);

CREATE TABLE UTILIZZA (
    CodiceIntervento INT,
    CodicePezzo INT,
    Quantita INT DEFAULT 1,
    PRIMARY KEY (CodiceIntervento, CodicePezzo),
    FOREIGN KEY (CodiceIntervento) REFERENCES INTERVENTO(Codice),
    FOREIGN KEY (CodicePezzo) REFERENCES PEZZO_DI_RICAMBIO(CodicePezzo)
);