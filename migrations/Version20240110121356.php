<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110121356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_reservation_item (reservation_id INT NOT NULL, reservation_item_id INT NOT NULL, INDEX IDX_67D01FEB83297E7 (reservation_id), INDEX IDX_67D01FE75FAE9DB (reservation_item_id), PRIMARY KEY(reservation_id, reservation_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_reservation_item ADD CONSTRAINT FK_67D01FEB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_reservation_item ADD CONSTRAINT FK_67D01FE75FAE9DB FOREIGN KEY (reservation_item_id) REFERENCES reservation_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_reservation_item DROP FOREIGN KEY FK_67D01FEB83297E7');
        $this->addSql('ALTER TABLE reservation_reservation_item DROP FOREIGN KEY FK_67D01FE75FAE9DB');
        $this->addSql('DROP TABLE reservation_reservation_item');
    }
}
