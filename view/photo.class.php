<?php
//class de test
   class Photo {
      public function html() {
       echo ' 
       <h1>Photo</h1>
       <form action="photo.html" method="POST" enctype="multipart/form-data">
       <label for="photo">Fichier</label>
       <input type="file" name="photo">
       <button type="submit">Enregistrer</button>
      </form>
         ';
      }
   }