<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006184027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, formule_id INT NOT NULL, vehicule_id INT NOT NULL, payment_id INT DEFAULT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL, end_at DATETIME NOT NULL, etat VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_351268BB2A68F4D1 (formule_id), UNIQUE INDEX UNIQ_351268BB4A4A3511 (vehicule_id), UNIQUE INDEX UNIQ_351268BB4C3A3BB (payment_id), INDEX IDX_351268BB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB2A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE abonnement');
    }
}
