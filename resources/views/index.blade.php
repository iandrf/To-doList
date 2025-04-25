<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Tugas</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 p-6">

        <!-- Fixed Header Section -->
        <header class="bg-blue-600 text-white p-4 rounded-lg shadow-md fixed top-0 left-0 right-0 z-10">
            <h1 class="text-3xl font-bold text-center">Aplikasi Daftar Tugas</h1>
            <p class="text-center mt-2">Kelola tugas Anda dengan mudah dan efisien</p>
        </header>

        <!-- Main Content Section -->
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-24">
            <div class="flex justify-between items-center mb-4">
                <!-- Daftar Tugas Title -->
                <h2 class="text-2xl font-bold">Daftar Tugas</h2>

                <!-- Tombol untuk membuka modal -->
                <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Tugas Baru</button>
            </div>
            
            <!-- Daftar Tugas -->
            <ul id="taskList" class="space-y-2">
                <!-- Daftar tugas yang ada -->
            </ul>
        </div>

        <!-- Modal Popup Form -->
        <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-xl font-semibold mb-4">Tambah Tugas Baru</h3>
                <input type="text" id="newTask" class="border border-gray-300 rounded px-4 py-2 w-full mb-4" placeholder="Masukkan tugas baru" />
                <div class="flex justify-end gap-4">
                    <button onclick="closeModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Tutup</button>
                    <button onclick="addTask()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Tugas</button>
                </div>
            </div>
        </div>

        <!-- Footer Section (Copyright) -->
        <footer class="fixed bottom-0 left-0 right-0 bg-gray-800 text-white text-center p-4">
            <p>&copy; 2025 Ian Andre. All rights reserved.</p>
        </footer>

        <script>
            let tasks = [
                {id: 1, title: 'Belajar PHP', status: 'belum'},
                {id: 2, title: 'Kerjakan tugas UX', status: 'selesai'},
            ];

            // Fungsi untuk menampilkan daftar tugas di halaman
            function displayTasks() {
                const taskList = document.getElementById('taskList');
                taskList.innerHTML = ''; // Menghapus daftar tugas lama

                tasks.forEach(task => {
                    const li = document.createElement('li');
                    li.classList.add('flex', 'items-center', 'justify-between', 'bg-gray-50', 'p-4', 'rounded-lg', 'shadow-md', 'border', 'border-gray-200');

                    // Checkbox untuk menandai tugas selesai
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.checked = task.status === 'selesai';
                    checkbox.classList.add('mr-4');
                    checkbox.onclick = function () { updateTaskStatus(task.id, checkbox.checked); };

                    const taskText = document.createElement('span');
                    taskText.textContent = task.title;
                    taskText.classList.add('text-gray-700', 'text-lg');
                    if (task.status === 'selesai') {
                        taskText.classList.add('line-through', 'text-gray-500');
                    }

                    // Tombol Hapus
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Hapus';
                    deleteButton.classList.add('bg-red-500', 'text-white', 'px-4', 'py-1', 'rounded', 'hover:bg-red-600', 'focus:outline-none');
                    deleteButton.onclick = function () { deleteTask(task.id); };

                    li.appendChild(checkbox);
                    li.appendChild(taskText);
                    li.appendChild(deleteButton);
                    taskList.appendChild(li);
                });
            }

            // Fungsi untuk menambahkan tugas baru
            function addTask() {
                const newTaskInput = document.getElementById('newTask');
                const newTask = newTaskInput.value.trim();
                
                if (newTask) {
                    const newId = tasks.length ? tasks[tasks.length - 1].id + 1 : 1; // Generate ID
                    tasks.push({id: newId, title: newTask, status: 'belum'});
                    newTaskInput.value = ''; // Kosongkan input setelah ditambahkan
                    closeModal(); // Tutup modal
                    displayTasks(); // Update tampilan daftar tugas
                } else {
                    alert('Tugas tidak boleh kosong!');
                }
            }

            // Fungsi untuk mengupdate status tugas
            function updateTaskStatus(id, isCompleted) {
                const task = tasks.find(task => task.id === id);
                if (task) {
                    task.status = isCompleted ? 'selesai' : 'belum';
                    displayTasks(); // Update tampilan tugas
                }
            }

            // Fungsi untuk menghapus tugas
            function deleteTask(id) {
                if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                    tasks = tasks.filter(task => task.id !== id);
                    displayTasks(); // Update tampilan setelah penghapusan
                }
            }

            // Fungsi untuk membuka modal
            function openModal() {
                document.getElementById('modal').classList.remove('hidden');
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }

            // Menampilkan daftar tugas saat halaman dimuat
            displayTasks();
        </script>

    </body>
</html>
