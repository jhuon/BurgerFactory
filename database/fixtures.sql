/* Burger Fixtures */
INSERT INTO Burger VALUES(1, "Big Mac", "images/big-mac.png", "Ses deux steaks hachés, son cheddar fondu, ses oignons, ses cornichons, son lit de salade et sa sauce inimitable, font du Big Mac un sandwich culte et indémodable.", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(2, "Royal Bacon", "images/royal-bacon.png", "Avec son bacon croustillant, son steak haché et son pain aux graines de sésame, il vous offre une recette savoureuse et gourmande.", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(3, "Royal Cheese", "images/royal-cheese.png", "Deux tranches de cheddar fondu accompagnent son steack haché pur bœuf. Des cornichons, de l'oignon, un peu de moutarde et du ketchup et on dit tous Cheese!", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(4, "Royal Deluxe", "images/royal-deluxe.png", "Craquez pour un savoureux steak haché avec du cheddar fondu, de la salade croquante et des oignons frais, le tout accompagné d'une délicieuse sauce à la moutarde à l'ancienne qui lui donne son goût si original.", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(5, "McChicken", "images/mcchicken.png", "Notre spécialité panée au poulet, sa salade croquante et sa sauce légèrement citronnée font du McChicken un succès incontesté et surtout incontestable depuis 1980.", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(6, "Grand Chicago Classic", "images/grand-chicago-classic.png", "Redécouvrez le goût inimitable du Grand Chicago Classic : Son pain aux graines de sésame, son bœuf au goût grillé, sa tranche de tomate ainsi que ses oignons rouges croquants, le tout sublimé par une sauce onctueuse au goût fumé.", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(7, "Filet-o-fish", "images/filet-o-fish.png", "Fondez pour son poisson pané croustillant et sa sauce légèrement vinaigrée aux oignons et aux câpres, le tout dans un pain cuit vapeur. Laissez-vous prendre dans ses filets !", 1, CURRENT_TIMESTAMP);
INSERT INTO Burger VALUES(8, "Double Cheese", "images/double-cheese.png", "Un goût culte : 2 steaks hachés cuits au grill, 2 tranches de cheddar fondu, 2 sauces ketchup et moutarde… 2 fois plus de plaisir !", 1, CURRENT_TIMESTAMP);


/* Ingredient Fixtures */
INSERT INTO Ingredient VALUES(1, "Pain spécial", 0);
INSERT INTO Ingredient VALUES(2, "Steak haché", 0);
INSERT INTO Ingredient VALUES(3, "Poulet", 0);
INSERT INTO Ingredient VALUES(4, "Bacon", 0);
INSERT INTO Ingredient VALUES(5, "Jambon", 0);
INSERT INTO Ingredient VALUES(6, "Poisson panée", 0);
INSERT INTO Ingredient VALUES(7, "Salade", 0);
INSERT INTO Ingredient VALUES(8, "Tomate", 0);
INSERT INTO Ingredient VALUES(9, "Oignon", 0);
INSERT INTO Ingredient VALUES(10, "Cornichon", 0);
INSERT INTO Ingredient VALUES(11, "Fromage fondu", 0);
INSERT INTO Ingredient VALUES(12, "Mayonnaise", 0);
INSERT INTO Ingredient VALUES(13, "Ketchup", 1);
INSERT INTO Ingredient VALUES(14, "Sauce au poivre", 2);
INSERT INTO Ingredient VALUES(15, "Moutarde", 3);
INSERT INTO Ingredient VALUES(16, "Harissa", 4);
INSERT INTO Ingredient VALUES(17, "Tabasco", 5);

/* BurgerIngredient Fixtures */
INSERT INTO BurgerIngredient VALUES(1,1,1,0);
INSERT INTO BurgerIngredient VALUES(2,1,2,0);
INSERT INTO BurgerIngredient VALUES(3,1,7,0);
INSERT INTO BurgerIngredient VALUES(4,1,9,0);
INSERT INTO BurgerIngredient VALUES(5,1,10,0);
INSERT INTO BurgerIngredient VALUES(6,1,11,0);
INSERT INTO BurgerIngredient VALUES(7,2,1,0);
INSERT INTO BurgerIngredient VALUES(8,2,2,0);
INSERT INTO BurgerIngredient VALUES(9,2,4,0);
INSERT INTO BurgerIngredient VALUES(10,2,11,0);
INSERT INTO BurgerIngredient VALUES(11,2,9,0);
INSERT INTO BurgerIngredient VALUES(12,2,13,0);
INSERT INTO BurgerIngredient VALUES(13,2,15,0);
