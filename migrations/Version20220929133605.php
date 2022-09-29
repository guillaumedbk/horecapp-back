<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929133605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE category category enum(\'APPETIZER\', \'MAIN\', \'DESERT\', \'VEGE\', \'VEGAN\')');
        $this->addSql('ALTER TABLE restaurant CHANGE type type enum(\'GASTRONOMIC\', \'ITALIAN\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `dish` CHANGE id id INT NOT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `restaurant` CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
