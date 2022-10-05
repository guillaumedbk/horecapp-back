<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005135115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish ADD restaurant_id VARCHAR(255) NOT NULL, ADD order_id VARCHAR(255) NOT NULL, CHANGE category category enum(\'APPETIZER\', \'MAIN\', \'DESERT\', \'VEGE\', \'VEGAN\')');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8B1E7706E FOREIGN KEY (restaurant_id) REFERENCES `restaurant` (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB88D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_957D8CB8B1E7706E ON dish (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_957D8CB88D9F6D38 ON dish (order_id)');
        $this->addSql('ALTER TABLE `order` ADD user_id VARCHAR(255) NOT NULL, ADD restaurant_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B1E7706E FOREIGN KEY (restaurant_id) REFERENCES `restaurant` (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
        $this->addSql('CREATE INDEX IDX_F5299398B1E7706E ON `order` (restaurant_id)');
        $this->addSql('ALTER TABLE restaurant ADD user_id VARCHAR(255) NOT NULL, CHANGE type type enum(\'GASTRONOMIC\', \'ITALIAN\')');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FA76ED395 ON restaurant (user_id)');
        $this->addSql('ALTER TABLE dish CHANGE restaurant_id restaurant_id VARCHAR(255) DEFAULT NULL, CHANGE order_id order_id VARCHAR(255) DEFAULT NULL, CHANGE category category enum(\'APPETIZER\', \'MAIN\', \'DESERT\', \'VEGE\', \'VEGAN\')');
        $this->addSql('ALTER TABLE restaurant CHANGE type type enum(\'GASTRONOMIC\', \'ITALIAN\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `dish` DROP FOREIGN KEY FK_957D8CB8B1E7706E');
        $this->addSql('ALTER TABLE `dish` DROP FOREIGN KEY FK_957D8CB88D9F6D38');
        $this->addSql('DROP INDEX IDX_957D8CB8B1E7706E ON `dish`');
        $this->addSql('DROP INDEX IDX_957D8CB88D9F6D38 ON `dish`');
        $this->addSql('ALTER TABLE `dish` DROP restaurant_id, DROP order_id, CHANGE category category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `restaurant` DROP FOREIGN KEY FK_EB95123FA76ED395');
        $this->addSql('DROP INDEX IDX_EB95123FA76ED395 ON `restaurant`');
        $this->addSql('ALTER TABLE `restaurant` DROP user_id, CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B1E7706E');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398B1E7706E ON `order`');
        $this->addSql('ALTER TABLE `order` DROP user_id, DROP restaurant_id');
        $this->addSql('ALTER TABLE `dish` CHANGE restaurant_id restaurant_id VARCHAR(255) NOT NULL, CHANGE order_id order_id VARCHAR(255) NOT NULL, CHANGE category category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `restaurant` CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
