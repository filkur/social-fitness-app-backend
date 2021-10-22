<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022220116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Activity (id UUID NOT NULL, event_id UUID NOT NULL, value INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, eventMember_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_55026B0C9F4AFDED ON Activity (eventMember_id)');
        $this->addSql('CREATE INDEX IDX_55026B0C71F7E88B ON Activity (event_id)');
        $this->addSql('COMMENT ON COLUMN Activity.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Activity.event_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Activity.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Activity.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Activity.eventMember_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE Comment (id UUID NOT NULL, owner_id UUID NOT NULL, post_id UUID NOT NULL, content VARCHAR(200) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5BC96BF07E3C61F9 ON Comment (owner_id)');
        $this->addSql('CREATE INDEX IDX_5BC96BF04B89032C ON Comment (post_id)');
        $this->addSql('COMMENT ON COLUMN Comment.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Comment.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE Event (id UUID NOT NULL, group_id UUID NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(200) NOT NULL, point_goal INT DEFAULT NULL, points_per_minute INT DEFAULT NULL, points_per_rep INT DEFAULT NULL, is_active BOOLEAN NOT NULL, event_type VARCHAR(255) NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FA6F25A3FE54D947 ON Event (group_id)');
        $this->addSql('COMMENT ON COLUMN Event.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Event.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Event.start_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Event.end_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Event.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Event.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE Post (id UUID NOT NULL, group_id UUID DEFAULT NULL, owner_id UUID NOT NULL, content VARCHAR(400) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FAB8C3B3FE54D947 ON Post (group_id)');
        $this->addSql('CREATE INDEX IDX_FAB8C3B37E3C61F9 ON Post (owner_id)');
        $this->addSql('COMMENT ON COLUMN Post.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Post.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE event_member (id UUID NOT NULL, user_id UUID DEFAULT NULL, event_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_427D8D2AA76ED395 ON event_member (user_id)');
        $this->addSql('CREATE INDEX IDX_427D8D2A71F7E88B ON event_member (event_id)');
        $this->addSql('COMMENT ON COLUMN event_member.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN event_member.user_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN event_member.event_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN event_member.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN event_member.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE group_member (id UUID NOT NULL, user_id UUID DEFAULT NULL, group_id UUID NOT NULL, assigned_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A36222A8A76ED395 ON group_member (user_id)');
        $this->addSql('CREATE INDEX IDX_A36222A8FE54D947 ON group_member (group_id)');
        $this->addSql('COMMENT ON COLUMN group_member.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.user_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.assigned_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE groups (id UUID NOT NULL, owner_id UUID DEFAULT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(200) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F06D39707E3C61F9 ON groups (owner_id)');
        $this->addSql('COMMENT ON COLUMN groups.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN groups.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN groups.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN groups.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE invitation (id UUID NOT NULL, group_id UUID DEFAULT NULL, code VARCHAR(8) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F11D61A2FE54D947 ON invitation (group_id)');
        $this->addSql('COMMENT ON COLUMN invitation.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN invitation.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN invitation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN invitation.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, nickname VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, email VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A188FE64 ON users (nickname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Activity ADD CONSTRAINT FK_55026B0C9F4AFDED FOREIGN KEY (eventMember_id) REFERENCES event_member (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Activity ADD CONSTRAINT FK_55026B0C71F7E88B FOREIGN KEY (event_id) REFERENCES Event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF07E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF04B89032C FOREIGN KEY (post_id) REFERENCES Post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B3FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B37E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A71F7E88B FOREIGN KEY (event_id) REFERENCES Event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_member ADD CONSTRAINT FK_A36222A8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_member ADD CONSTRAINT FK_A36222A8FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D39707E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE Activity DROP CONSTRAINT FK_55026B0C71F7E88B');
        $this->addSql('ALTER TABLE event_member DROP CONSTRAINT FK_427D8D2A71F7E88B');
        $this->addSql('ALTER TABLE Comment DROP CONSTRAINT FK_5BC96BF04B89032C');
        $this->addSql('ALTER TABLE Activity DROP CONSTRAINT FK_55026B0C9F4AFDED');
        $this->addSql('ALTER TABLE Event DROP CONSTRAINT FK_FA6F25A3FE54D947');
        $this->addSql('ALTER TABLE Post DROP CONSTRAINT FK_FAB8C3B3FE54D947');
        $this->addSql('ALTER TABLE group_member DROP CONSTRAINT FK_A36222A8FE54D947');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2FE54D947');
        $this->addSql('ALTER TABLE Comment DROP CONSTRAINT FK_5BC96BF07E3C61F9');
        $this->addSql('ALTER TABLE Post DROP CONSTRAINT FK_FAB8C3B37E3C61F9');
        $this->addSql('ALTER TABLE event_member DROP CONSTRAINT FK_427D8D2AA76ED395');
        $this->addSql('ALTER TABLE group_member DROP CONSTRAINT FK_A36222A8A76ED395');
        $this->addSql('ALTER TABLE groups DROP CONSTRAINT FK_F06D39707E3C61F9');
        $this->addSql('DROP TABLE Activity');
        $this->addSql('DROP TABLE Comment');
        $this->addSql('DROP TABLE Event');
        $this->addSql('DROP TABLE Post');
        $this->addSql('DROP TABLE event_member');
        $this->addSql('DROP TABLE group_member');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE users');
    }
}
