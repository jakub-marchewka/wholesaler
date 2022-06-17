<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617130219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD email VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD nip VARCHAR(255) NOT NULL, ADD company_name VARCHAR(255) NOT NULL, ADD street VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD building_number VARCHAR(255) NOT NULL, ADD local_number VARCHAR(255) DEFAULT NULL, ADD post_code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP email, DROP phone, DROP nip, DROP company_name, DROP street, DROP city, DROP building_number, DROP local_number, DROP post_code');
    }
}
