CREATE INDEX idx_benutzer_id ON benutzer (id);
CREATE INDEX idx_gericht_id ON gericht (id);

CREATE TABLE Bewertung (
                           id INT PRIMARY KEY,
                           user_id bigint,
                           gericht_id bigint,
                           bewertung VARCHAR(255) CHECK(LENGTH(bewertung) >= 5),
                           sterne_bewertung ENUM('sehr gut', 'gut', 'schlecht', 'sehr schlecht'),
                           adminapproved BOOLEAN,
                           erfasst_am DATETIME,
                           FOREIGN KEY (user_id) REFERENCES benutzer(id),
                           FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);
