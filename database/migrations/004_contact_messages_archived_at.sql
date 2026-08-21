ALTER TABLE contact_messages
  ADD COLUMN archived_at DATETIME DEFAULT NULL AFTER status,
  ADD INDEX idx_contact_messages_archived_at (archived_at);
