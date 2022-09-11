<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220911172633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create contact table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id SERIAL NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, birthday VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, picture VARCHAR(255))');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT contact_phone_unique UNIQUE(phone)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT contact_email_unique UNIQUE(email)');
        $this->addSql('CREATE EXTENSION pg_trgm');
        $this->addSql('CREATE INDEX trgm_contact_full_name_idx ON contact USING GIN ((first_name || \' \' || last_name) gin_trgm_ops)');
        $this->addSql('CREATE INDEX trgm_contact_first_name_idx ON contact USING GIN (first_name gin_trgm_ops)');
        $this->addSql('CREATE INDEX trgm_contact_last_name_idx ON contact USING GIN (last_name gin_trgm_ops)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP INDEX trgm_contact_full_name_idx');
        $this->addSql('ALTER TABLE contact DROP INDEX trgm_contact_first_name_idx');
        $this->addSql('ALTER TABLE contact DROP INDEX trgm_contact_last_name_idx');
        $this->addSql('DROP TABLE contact');
    }
}
