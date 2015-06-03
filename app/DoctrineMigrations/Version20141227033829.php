<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20141227033829 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Cidade (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nome VARCHAR(35) NOT NULL, slug VARCHAR(35) NOT NULL, INDEX IDX_6D34366A9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Entidade (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, nome VARCHAR(100) NOT NULL, endereco VARCHAR(100) NOT NULL, cep VARCHAR(9), bairro VARCHAR(50), telefone VARCHAR(50), site VARCHAR(200) NOT NULL, email VARCHAR(50), created_at DATETIME NOT NULL, INDEX IDX_1A5F84849586CC8 (cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Estado (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Vaga (id INT AUTO_INCREMENT NOT NULL, entidade_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, descricao LONGTEXT NOT NULL, como_aplicar LONGTEXT NOT NULL, online TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_963E82DBA2DAE88B (entidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Voluntario (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, nome VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, telefone VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_6E3F322E9586CC8 (cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Cidade ADD CONSTRAINT FK_6D34366A9F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id)');
        $this->addSql('ALTER TABLE Entidade ADD CONSTRAINT FK_1A5F84849586CC8 FOREIGN KEY (cidade_id) REFERENCES Cidade (id)');
        $this->addSql('ALTER TABLE Vaga ADD CONSTRAINT FK_963E82DBA2DAE88B FOREIGN KEY (entidade_id) REFERENCES Entidade (id)');
        $this->addSql('ALTER TABLE Voluntario ADD CONSTRAINT FK_6E3F322E9586CC8 FOREIGN KEY (cidade_id) REFERENCES Cidade (id)');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entidade DROP FOREIGN KEY FK_1A5F84849586CC8');
        $this->addSql('ALTER TABLE Voluntario DROP FOREIGN KEY FK_6E3F322E9586CC8');
        $this->addSql('ALTER TABLE Vaga DROP FOREIGN KEY FK_963E82DBA2DAE88B');
        $this->addSql('ALTER TABLE Cidade DROP FOREIGN KEY FK_6D34366A9F5A440B');
        $this->addSql('DROP TABLE Cidade');
        $this->addSql('DROP TABLE Entidade');
        $this->addSql('DROP TABLE Estado');
        $this->addSql('DROP TABLE Vaga');
        $this->addSql('DROP TABLE Voluntario');
    }
}
