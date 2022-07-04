<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703185847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account (id UUID NOT NULL, bic VARCHAR(50) DEFAULT NULL, balance VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_53A23E0AD4962650 ON bank_account (bic)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_53A23E0AACF41FFE ON bank_account (balance)');
        $this->addSql('COMMENT ON COLUMN bank_account.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE client (id UUID NOT NULL, name VARCHAR(50) DEFAULT NULL, surname VARCHAR(50) DEFAULT NULL, email CHAR(32) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE client_bank_account (client_id UUID NOT NULL, bank_account_id UUID NOT NULL, PRIMARY KEY(client_id, bank_account_id))');
        $this->addSql('CREATE INDEX IDX_E2A89C0B19EB6921 ON client_bank_account (client_id)');
        $this->addSql('CREATE INDEX IDX_E2A89C0B12CB990C ON client_bank_account (bank_account_id)');
        $this->addSql('COMMENT ON COLUMN client_bank_account.client_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN client_bank_account.bank_account_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE client_bank_account ADD CONSTRAINT FK_E2A89C0B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_bank_account ADD CONSTRAINT FK_E2A89C0B12CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client_bank_account DROP CONSTRAINT FK_E2A89C0B12CB990C');
        $this->addSql('ALTER TABLE client_bank_account DROP CONSTRAINT FK_E2A89C0B19EB6921');
        $this->addSql('DROP TABLE bank_account');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_bank_account');
    }
}
