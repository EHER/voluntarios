<?php
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150628024953 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('INSERT INTO User (email, password, is_admin) VALUES (\'alexandre@eher.com.br\', \'$2y$12$pAy2JnGq1Et9XOJnKBKI2OvhVDYeMUu2P6dOuPJFuX6.77nU5k6My\', 1);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM User WHERE email = \'alexandre@eher.com.br\';');
    }
}
