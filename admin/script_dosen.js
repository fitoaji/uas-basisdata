document.addEventListener("DOMContentLoaded", loadDosen);

let mode = "tambah"; // tambah | edit

function loadDosen() {
    fetch("api_dosen.php?action=get")
        .then(res => res.json())
        .then(data => {
            let html = "";
            data.forEach((d, i) => {
                html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${d.nidn}</td>
                    <td>${d.nama}</td>
                    <td>${d.email}</td>
                    <td>
                        <button onclick="edit(${d.id_dosen}, '${d.nidn}', '${d.nama}', '${d.email}')">Edit</button>
                        <button onclick="hapus(${d.id_dosen})"> Hapus</button>
                    </td>
                </tr>
                `;
            });
            document.getElementById("data-dosen").innerHTML = html;
        });
}

// FORM
function showForm() {
    mode = "tambah";
    formDosen.style.display = "block";
    id_dosen.value = "";
    nidn.value = "";
    nama.value = "";
    email.value = "";
}

function batal() {
    formDosen.style.display = "none";
}

// TAMBAH / UPDATE
function simpan() {
    let data = new URLSearchParams();
    data.append("nidn", nidn.value);
    data.append("nama", nama.value);
    data.append("email", email.value);

    let url = "api_dosen.php?action=tambah";

    if (mode === "edit") {
        data.append("id", id_dosen.value);
        url = "api_dosen.php?action=update";
    }

    fetch(url, {
        method: "POST",
        body: data
    }).then(() => {
        loadDosen();
        formDosen.style.display = "none";
    });
}

// EDIT
function edit(id, n, nm, em) {
    mode = "edit";
    formDosen.style.display = "block";
    id_dosen.value = id;
    nidn.value = n;
    nama.value = nm;
    email.value = em;
}

// HAPUS
function hapus(id) {
    if (!confirm("Yakin hapus data?")) return;

    fetch("api_dosen.php?action=hapus", {
        method: "POST",
        body: new URLSearchParams({ id })
    }).then(() => loadDosen());
}
