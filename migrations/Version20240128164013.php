<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128164013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD content VARCHAR(255) DEFAULT NULL, ADD creation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE image DROP alt');
        $this->addSql('ALTER TABLE media ADD alt VARCHAR(50) DEFAULT NULL, CHANGE filename filename VARCHAR(255) DEFAULT NULL, CHANGE size size INT DEFAULT NULL, CHANGE type type VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE trick CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP content, DROP creation_date');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image ADD alt VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media DROP alt, CHANGE filename filename VARCHAR(255) NOT NULL, CHANGE size size INT NOT NULL, CHANGE type type VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE trick CHANGE title title VARCHAR(255) NOT NULL');
    }
}
