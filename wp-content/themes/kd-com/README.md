1. **Compiler les fichiers Sass**  
   Lancez la commande suivante pour compiler un fichier `.scss` en `.css` :
   ```bash
   sass wp-content/themes/kd-com/sass/style.scss wp-content/themes/kd-com/style.css
   ```
   - `src/scss/style.scss` : chemin du fichier source Sass
   - `style.css` : fichier CSS généré

2. **Surveiller les changements automatiquement**  
   Pour compiler automatiquement à chaque modification :
   ```bash
   sass --watch wp-content/themes/kd-com/sass/style.scss wp-content/themes/kd-com/style.css
   ```

3. **Options utiles**  
   - Pour une sortie compressée :
     ```bash
     sass --style=compressed wp-content/themes/kd-com/sass/style.scss wp-content/themes/kd-com/style.css
     ```

4. **Dépannage**  
   - Vérifiez que Node.js est installé :  
     ```bash
     node -v
     ```
   - Si la commande `sass` n’est pas reconnue, relancez votre terminal ou vérifiez l’installation.