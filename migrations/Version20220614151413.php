<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614151413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subscribed_product_user (subscribed_product_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_5C794E4E9ECFF961 (subscribed_product_id), INDEX IDX_5C794E4EA76ED395 (user_id), PRIMARY KEY(subscribed_product_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscribed_product_user ADD CONSTRAINT FK_5C794E4E9ECFF961 FOREIGN KEY (subscribed_product_id) REFERENCES subscribed_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribed_product_user ADD CONSTRAINT FK_5C794E4EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribed_product DROP INDEX IDX_1E1983D14584665A, ADD UNIQUE INDEX UNIQ_1E1983D14584665A (product_id)');
        $this->addSql('ALTER TABLE subscribed_product DROP FOREIGN KEY FK_1E1983D1A76ED395');
        $this->addSql('DROP INDEX IDX_1E1983D1A76ED395 ON subscribed_product');
        $this->addSql('ALTER TABLE subscribed_product DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subscribed_product_user');
        $this->addSql('ALTER TABLE subscribed_product DROP INDEX UNIQ_1E1983D14584665A, ADD INDEX IDX_1E1983D14584665A (product_id)');
        $this->addSql('ALTER TABLE subscribed_product ADD user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE subscribed_product ADD CONSTRAINT FK_1E1983D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1E1983D1A76ED395 ON subscribed_product (user_id)');
    }
}
