<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150603005651 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entidade ADD contato VARCHAR(50) DEFAULT NULL, ADD latitude NUMERIC(18, 12) DEFAULT NULL, ADD longitude NUMERIC(18, 12) DEFAULT NULL, CHANGE endereco endereco VARCHAR(100) DEFAULT NULL, CHANGE site site VARCHAR(200) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entidade DROP contato, DROP latitude, DROP longitude, CHANGE endereco endereco VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE site site VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
    }
}
