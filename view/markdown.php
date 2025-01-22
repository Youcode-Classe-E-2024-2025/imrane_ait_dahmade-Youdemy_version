


<div class="container max-w-4xl mx-auto shadow-lg bg-white p-6 rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-4">Éditeur Markdown</h1>
        
        <form action="post" name="Document" class="space-y-4">
        
        <div class="mb-4">
            <label for="NomCour" class="form-label font-semibold">Entrer le nom du cours</label>
            <input 
                type="text" 
                name="NomCour" 
                id="NomCour" 
                class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <!-- Description -->
        <div class="mb-4">
            <label for="Description" class="form-label font-semibold">Entrer une description</label>
            <textarea 
                name="Description" 
                id="Description" 
                rows="4" 
                class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>
            <div>
                <textarea 
                    name="Document" 
                    id="editor" 
                    class="w-full rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                ></textarea>
            </div>
            <div class="mb-4">
            <label for="Image" class="form-label font-semibold">Télécharger une image</label>
            <input 
                type="file" 
                name="Image" 
                id="Image" 
                class="form-control border border-gray-300 rounded-lg p-2">
        </div>
        <!-- Catégorie -->
        <div class="mb-4">
            <label for="Categorie" class="form-label font-semibold">Catégorie</label>
            <select 
                name="Categorie" 
                id="Categorie" 
                class="form-select border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="" disabled selected>Choisir une catégorie</option>
                <option value="1">Catégorie 1</option>
                <option value="2">Catégorie 2</option>
            </select>
        </div>
        <!-- Tags -->
        <div class="mb-4">
            <label for="Tags" class="form-label font-semibold">Tags</label>
            <select 
                name="Tags" 
                id="Tags" 
                class="form-select border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="" disabled selected>Choisir des tags</option>
                <option value="tag1">Tag 1</option>
                <option value="tag2">Tag 2</option>
            </select>
        </div>
            
            <button 
                type="submit" 
                class="btn btn-primary w-full py-2 text-lg">
                Enregistrer
            </button>
        </form>
    </div>
    <script src="./script.js"></script>
