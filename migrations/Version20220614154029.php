<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614154029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD subscribers_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4F6E6AC1 FOREIGN KEY (subscribers_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD4F6E6AC1 ON product (subscribers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4F6E6AC1');
        $this->addSql('DROP INDEX IDX_D34A04AD4F6E6AC1 ON product');
        $this->addSql('ALTER TABLE product DROP subscribers_id');
    }
}
