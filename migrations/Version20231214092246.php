<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214092246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE items_reservationitem (items_id INT NOT NULL, reservationitem_id INT NOT NULL, INDEX IDX_F970AF636BB0AE84 (items_id), INDEX IDX_F970AF63A3ADFC46 (reservationitem_id), PRIMARY KEY(items_id, reservationitem_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items_reservationitem ADD CONSTRAINT FK_F970AF636BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE items_reservationitem ADD CONSTRAINT FK_F970AF63A3ADFC46 FOREIGN KEY (reservationitem_id) REFERENCES reservation_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_reservationitem DROP FOREIGN KEY FK_F970AF636BB0AE84');
        $this->addSql('ALTER TABLE items_reservationitem DROP FOREIGN KEY FK_F970AF63A3ADFC46');
        $this->addSql('DROP TABLE items_reservationitem');
    }
}
