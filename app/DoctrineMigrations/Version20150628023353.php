<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150628023353 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE Cidade (id INTEGER NOT NULL, estado_id INTEGER DEFAULT NULL, nome VARCHAR(35) NOT NULL, slug VARCHAR(35) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D34366A9F5A440B ON Cidade (estado_id)');
        $this->addSql('CREATE TABLE Entidade (id INTEGER NOT NULL, cidade_id INTEGER DEFAULT NULL, nome VARCHAR(100) NOT NULL, endereco VARCHAR(200) DEFAULT NULL, cep VARCHAR(30) DEFAULT NULL, bairro VARCHAR(100) DEFAULT NULL, telefone VARCHAR(100) DEFAULT NULL, site VARCHAR(200) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, contato VARCHAR(50) DEFAULT NULL, latitude NUMERIC(18, 12) DEFAULT NULL, longitude NUMERIC(18, 12) DEFAULT NULL, geohash VARCHAR(12) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1A5F84849586CC8 ON Entidade (cidade_id)');
        $this->addSql('CREATE TABLE Estado (id INTEGER NOT NULL, nome VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Vaga (id INTEGER NOT NULL, entidade_id INTEGER DEFAULT NULL, nome VARCHAR(255) NOT NULL, descricao CLOB NOT NULL, como_aplicar CLOB NOT NULL, online BOOLEAN NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_963E82DBA2DAE88B ON Vaga (entidade_id)');
        $this->addSql('CREATE TABLE Voluntario (id INTEGER NOT NULL, cidade_id INTEGER DEFAULT NULL, nome VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, telefone VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6E3F322E9586CC8 ON Voluntario (cidade_id)');
        $this->addSql('CREATE TABLE AccessToken (id INTEGER NOT NULL, client_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INTEGER DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B39617F55F37A13B ON AccessToken (token)');
        $this->addSql('CREATE INDEX IDX_B39617F519EB6921 ON AccessToken (client_id)');
        $this->addSql('CREATE INDEX IDX_B39617F5A76ED395 ON AccessToken (user_id)');
        $this->addSql('CREATE TABLE AuthCode (id INTEGER NOT NULL, client_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri CLOB NOT NULL, expires_at INTEGER DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F1D7D1775F37A13B ON AuthCode (token)');
        $this->addSql('CREATE INDEX IDX_F1D7D17719EB6921 ON AuthCode (client_id)');
        $this->addSql('CREATE INDEX IDX_F1D7D177A76ED395 ON AuthCode (user_id)');
        $this->addSql('CREATE TABLE Client (id INTEGER NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris CLOB NOT NULL, secret VARCHAR(255) NOT NULL, allowed_grant_types CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE RefreshToken (id INTEGER NOT NULL, client_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INTEGER DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7142379E5F37A13B ON RefreshToken (token)');
        $this->addSql('CREATE INDEX IDX_7142379E19EB6921 ON RefreshToken (client_id)');
        $this->addSql('CREATE INDEX IDX_7142379EA76ED395 ON RefreshToken (user_id)');
        $this->addSql('CREATE TABLE User (id INTEGER NOT NULL, email VARCHAR(25) NOT NULL, password VARCHAR(60) NOT NULL, is_admin BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DA17977E7927C74 ON User (email)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE Cidade');
        $this->addSql('DROP TABLE Entidade');
        $this->addSql('DROP TABLE Estado');
        $this->addSql('DROP TABLE Vaga');
        $this->addSql('DROP TABLE Voluntario');
        $this->addSql('DROP TABLE AccessToken');
        $this->addSql('DROP TABLE AuthCode');
        $this->addSql('DROP TABLE Client');
        $this->addSql('DROP TABLE RefreshToken');
        $this->addSql('DROP TABLE User');
    }
}
