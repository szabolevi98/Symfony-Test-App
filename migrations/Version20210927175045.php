<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927175045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, type TINYINT(1) NOT NULL, name LONGTEXT NOT NULL, phone LONGTEXT NOT NULL, tax_num INT NOT NULL, country LONGTEXT NOT NULL, city LONGTEXT NOT NULL, address LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE billing_address');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE billing_address (id INT NOT NULL, type TINYINT(1) DEFAULT \'b\'0\'\' NOT NULL, name VARCHAR(50) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, phone VARCHAR(50) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, tax_num INT DEFAULT NULL, country VARCHAR(50) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, city VARCHAR(50) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, address VARCHAR(100) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE address');
    }
}
