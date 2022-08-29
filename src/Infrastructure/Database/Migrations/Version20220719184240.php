<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719184240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE continent (id UUID NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN continent.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE country (id UUID NOT NULL, continent_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(36) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5373C966921F4C77 ON country (continent_id)');
        $this->addSql('COMMENT ON COLUMN country.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN country.continent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE team (id UUID NOT NULL, country_id UUID DEFAULT NULL, type_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C4E0A61FF92F3E70 ON team (country_id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FC54C8C93 ON team (type_id)');
        $this->addSql('COMMENT ON COLUMN team.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team.country_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team.type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE team_type (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN team_type.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FC54C8C93 FOREIGN KEY (type_id) REFERENCES team_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE country DROP CONSTRAINT FK_5373C966921F4C77');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61FF92F3E70');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61FC54C8C93');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_type');
    }
}
