CREATE TABLE Cidade (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nome VARCHAR(35) NOT NULL, slug VARCHAR(35) NOT NULL, INDEX IDX_6D34366A9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Entidade (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, nome VARCHAR(50) NOT NULL, endereco VARCHAR(50) NOT NULL, cep VARCHAR(9) NOT NULL, bairro VARCHAR(50) NOT NULL, telefone VARCHAR(50) NOT NULL, site VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1A5F84849586CC8 (cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Estado (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Vaga (id INT AUTO_INCREMENT NOT NULL, entidade_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, descricao LONGTEXT NOT NULL, como_aplicar LONGTEXT NOT NULL, online TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_963E82DBA2DAE88B (entidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Voluntario (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, nome VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, telefone VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_6E3F322E9586CC8 (cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE Cidade ADD CONSTRAINT FK_6D34366A9F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE Entidade ADD CONSTRAINT FK_1A5F84849586CC8 FOREIGN KEY (cidade_id) REFERENCES Cidade (id);
ALTER TABLE Vaga ADD CONSTRAINT FK_963E82DBA2DAE88B FOREIGN KEY (entidade_id) REFERENCES Entidade (id);
ALTER TABLE Voluntario ADD CONSTRAINT FK_6E3F322E9586CC8 FOREIGN KEY (cidade_id) REFERENCES Cidade (id);