
document.addEventListener('DOMContentLoaded', function() {
    const uploadPhotos = document.getElementById('uploadPhotos');
    const viewPhotos = document.getElementById('viewPhotos');
    const displayDiv = document.getElementById('display');

    const toggleCheckbox = document.getElementById('toggle');

    toggleCheckbox.addEventListener('change', function () {
        if (this.checked) {
            updateDisplay('View');
        } else {
            updateDisplay('Upload');
        }
    });

    function updateDisplay(section) {
        if (section === 'Upload') {
    // // Function to update the display with different content for each section
    // function updateDisplay(section) {
        // if (section === 'Upload') {
            displayDiv.innerHTML = `
                <div id="display" class="display container mt-3">

        <div class="left">

         <!-- file upload modal -->
         <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white shadow-xl rounded-md"
         ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
         ondragenter="dragEnterHandler(event);">
         <!-- overlay -->
         <div id="overlay"
             class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
             <i>
                 <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" viewBox="0 0 24 24">
                     <path
                         d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                 </svg>
             </i>
             <p class="text-lg text-blue-700">Drop files to upload</p>
         </div>

         <!-- scroll area -->
         <section class=" overflow-auto p-8 w-full h-full flex flex-col">
             <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center"  name="filename[]">
                 <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                     <span>Drag and drop your</span>&nbsp;<span>files anywhere or</span>
                 </p>
                 <input  name="filename[]"  id="hidden-input" type="file" multiple class="hidden" />
                 <button id="button" style="background-color: #A36361; "
                     onmouseover="this.style.backgroundColor='#A36361';"
                     onmouseout="this.style.backgroundColor='#E8B298'; "
                     class="mt-2 rounded-sm px-3 py-1 text-white hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                     Upload a file
                 </button>
             </header>

             <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                 To Upload
             </h1>

             <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                 <li id="empty"
                     class="h-full w-full text-center flex flex-col justify-center items-center">
                     <img class="mx-auto w-32"
                         src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                         alt="no data" />
                     <span class="text-small text-gray-500">No files selected</span>
                 </li>
             </ul>
         </section>


     </article>
     <!-- using two similar templates for simplicity in js code -->
     <template id="file-template">
         <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
             <article tabindex="0"
                 class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                 <img alt="upload preview"
                     class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                 <section
                     class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                     <h1 class="flex-1 group-hover:text-blue-800"></h1>
                     <div class="flex">
                         <span class="p-1 text-blue-800">
                             <i>
                                 <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24">
                                     <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                 </svg>
                             </i>
                         </span>
                         <p class="p-1 size text-xs text-gray-700"></p>
                         <button
                             class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                             <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24">
                                 <path class="pointer-events-none"
                                     d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                             </svg>
                         </button>
                     </div>
                 </section>
             </article>
         </li>
     </template>

     <template id="image-template">
         <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
             <article tabindex="0"
                 class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                 <img alt="upload preview"
                     class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                 <section
                     class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                     <h1 class="flex-1"></h1>
                     <div class="flex">
                         <span class="p-1">
                             <i>
                                 <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24">
                                     <path
                                         d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                 </svg>
                             </i>
                         </span>

                         <p class="p-1 size text-xs"></p>
                         <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                             <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24">
                                 <path class="pointer-events-none"
                                     d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                             </svg>
                         </button>
                     </div>
                 </section>
             </article>
         </li>
     </template>

    
    </div>
         

        <div class="right">
   
            <div class="description text-black mt-3 ">

                <h1 class="text-start mb-3 font-bold" >Choose a username:</h1>
                <select class="mb-5" name="user_id" required>
                    <option value="" disabled selected>Select a username</option>

                </select>

                <label for="message"
                    class="block mb-2 text-sm text-left font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="message" rows="10" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    placeholder="Write your thoughts here..."></textarea>

            </div>
               <!-- HTML !-->
<button class="buttonsub" role="button">Submit</button>

        </div>


    </div>
            `;
        } else {
            window.location.href = 'list-photos';
        }
    }

    // Event listeners
    uploadPhotos.addEventListener('click', function() {
        updateDisplay('Upload');
        uploadPhotos.classList.add('active');
        viewPhotos.classList.remove('active');
    });

    viewPhotos.addEventListener('click', function() {
        updateDisplay('View');
        viewPhotos.classList.add('active');
        uploadPhotos.classList.remove('active');
    });
});

        



        // upload file
        const fileTempl = document.getElementById("file-template"),
            imageTempl = document.getElementById("image-template"),
            empty = document.getElementById("empty");

        // use to store pre selected files
        let FILES = {};

        // check if file is of type image and prepend the initialied
        // template to the target element
        function addFile(target, file) {
            const isImage = file.type.match("image.*"),
                objectURL = URL.createObjectURL(file);

            const clone = isImage ?
                imageTempl.content.cloneNode(true) :
                fileTempl.content.cloneNode(true);

            clone.querySelector("h1").textContent = file.name;
            clone.querySelector("li").id = objectURL;
            clone.querySelector(".delete").dataset.target = objectURL;
            clone.querySelector(".size").textContent =
                file.size > 1024 ?
                file.size > 1048576 ?
                Math.round(file.size / 1048576) + "mb" :
                Math.round(file.size / 1024) + "kb" :
                file.size + "b";

            isImage &&
                Object.assign(clone.querySelector("img"), {
                    src: objectURL,
                    alt: file.name
                });

            empty.classList.add("hidden");
            target.prepend(clone);

            FILES[objectURL] = file;
        }

        const gallery = document.getElementById("gallery"),
            overlay = document.getElementById("overlay");

        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
            for (const file of e.target.files) {
                addFile(gallery, file);
            }
        };

        // use to check if a file is being dragged
        const hasFiles = ({
                dataTransfer: {
                    types = []
                }
            }) =>
            types.indexOf("Files") > -1;

        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;

        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
            ev.preventDefault();
            for (const file of ev.dataTransfer.files) {
                addFile(gallery, file);
                overlay.classList.remove("draggedover");
                counter = 0;
            }
        }

        // only react to actual files being dragged
        function dragEnterHandler(e) {
            e.preventDefault();
            if (!hasFiles(e)) {
                return;
            }
            ++counter && overlay.classList.add("draggedover");
        }

        function dragLeaveHandler(e) {
            1 > --counter && overlay.classList.remove("draggedover");
        }

        function dragOverHandler(e) {
            if (hasFiles(e)) {
                e.preventDefault();
            }
        }

        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        gallery.onclick = ({
            target
        }) => {
            if (target.classList.contains("delete")) {
                const ou = target.dataset.target;
                document.getElementById(ou).remove(ou);
                gallery.children.length === 1 && empty.classList.remove("hidden");
                delete FILES[ou];
            }
        };

        // print all selected files
        document.getElementById("submit").onclick = () => {
            alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
            console.log(FILES);
        };

        // clear entire selection
        document.getElementById("cancel").onclick = () => {
            while (gallery.children.length > 0) {
                gallery.lastChild.remove();
            }
            FILES = {};
            empty.classList.remove("hidden");
            gallery.append(empty);
        };



        