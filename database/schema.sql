CREATE TABLE Burger(
  id    INTEGER PRIMARY KEY,
  name  TEXT,
  image TEXT,
  description TEXT,
  version INTEGER DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Ingredient(
  id            INTEGER PRIMARY KEY,
  name          TEXT,
  spicy_level   INTEGER
);

CREATE TABLE BurgerIngredient(
  id             INTEGER PRIMARY KEY,
  burger_id      INTEGER NOT NULL,
  ingredient_id  INTEGER NOT NULL,
  weight         INTEGER DEFAULT 0,
  FOREIGN KEY(burger_id) REFERENCES Burger(id),
  FOREIGN KEY(ingredient_id) REFERENCES Ingredient(id) ON DELETE CASCADE ON UPDATE CASCADE
);
