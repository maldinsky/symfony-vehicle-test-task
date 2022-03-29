<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328205342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE make (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_1ACC766E8CDE5729 (type), UNIQUE INDEX UNIQ_1ACC766E771530988CDE5729 (code, type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_log (id INT AUTO_INCREMENT NOT NULL, vehicle_type VARCHAR(255) NOT NULL, vehicle_make VARCHAR(255) NOT NULL, number_models INT DEFAULT NULL, request_date DATETIME NOT NULL, user_ip VARCHAR(40) DEFAULT NULL, user_agent LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, make INT DEFAULT NULL, code VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_B53AF2358CDE5729 (type), INDEX IDX_B53AF2351ACC766E (make), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_type (code VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE make ADD CONSTRAINT FK_1ACC766E8CDE5729 FOREIGN KEY (type) REFERENCES vehicle_type (code)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF2358CDE5729 FOREIGN KEY (type) REFERENCES vehicle_type (code)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF2351ACC766E FOREIGN KEY (make) REFERENCES make (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF2351ACC766E');
        $this->addSql('ALTER TABLE make DROP FOREIGN KEY FK_1ACC766E8CDE5729');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF2358CDE5729');
        $this->addSql('DROP TABLE make');
        $this->addSql('DROP TABLE search_log');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP TABLE vehicle_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
