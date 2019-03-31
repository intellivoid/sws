CREATE TABLE cookies
(
  id INT AUTO_INCREMENT COMMENT 'Cookie ID' PRIMARY KEY,
  date_creation INT NULL COMMENT 'The unix timestamp of when the cookie was created',
  disposed TINYINT(1) NULL COMMENT 'Flag for if the cookie was disposed',
  name VARCHAR(255) NULL COMMENT 'The name of the Cookie (Public)',
  token VARCHAR(255) NULL COMMENT 'The public token of the cookie which uniquely identifies it',
  expires INT NULL COMMENT 'The Unix Timestamp of when the cookie should expire',
  ip_tied TINYINT(1) NULL COMMENT 'If the cookie should be strictly tied to the client''s IP Address',
  client_ip VARCHAR(255) NULL COMMENT 'The client''s IP Address of the cookie is tied to the IP',
  data BLOB NULL COMMENT 'ZiProto Encoded Data associated with the cookie',
  CONSTRAINT sws_id_uindex UNIQUE (id)
) COMMENT 'The main database for Secured Web Sessions library' ENGINE = InnoDB;