<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614141110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subscribed_product_product (subscribed_product_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_2F42198D9ECFF961 (subscribed_product_id), INDEX IDX_2F42198D4584665A (product_id), PRIMARY KEY(subscribed_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscribed_product_product ADD CONSTRAINT FK_2F42198D9ECFF961 FOREIGN KEY (subscribed_product_id) REFERENCES subscribed_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribed_product_product ADD CONSTRAINT FK_2F42198D4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribed_product DROP FOREIGN KEY FK_1E1983D14584665A');
        $this->addSql('DROP INDEX IDX_1E1983D14584665A ON subscribed_product');
        $this->addSql('ALTER TABLE subscribed_product DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subscribed_product_product');
        $this->addSql('ALTER TABLE subscribed_product ADD product_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE subscribed_product ADD CONSTRAINT FK_1E1983D14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1E1983D14584665A ON subscribed_product (product_id)');
    }
}
