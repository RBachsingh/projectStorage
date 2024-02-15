<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215091839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('ALTER TABLE reservation_comment ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_comment ADD CONSTRAINT FK_F3E1E9E9B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_F3E1E9E9B83297E7 ON reservation_comment (reservation_id)');
        $this->addSql('ALTER TABLE reservation_item ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_item ADD CONSTRAINT FK_922E876B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_922E876B83297E7 ON reservation_item (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP user_id');
        $this->addSql('ALTER TABLE reservation_comment DROP FOREIGN KEY FK_F3E1E9E9B83297E7');
        $this->addSql('DROP INDEX IDX_F3E1E9E9B83297E7 ON reservation_comment');
        $this->addSql('ALTER TABLE reservation_comment DROP reservation_id');
        $this->addSql('ALTER TABLE reservation_item DROP FOREIGN KEY FK_922E876B83297E7');
        $this->addSql('DROP INDEX IDX_922E876B83297E7 ON reservation_item');
        $this->addSql('ALTER TABLE reservation_item DROP reservation_id');
    }
}
