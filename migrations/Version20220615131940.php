<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615131940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE delivery_id delivery_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE status_id status_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE delivery_id delivery_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE status_id status_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }
}
