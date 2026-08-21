ALTER TABLE realisations
  ADD COLUMN client_partner VARCHAR(180) DEFAULT NULL AFTER body;
