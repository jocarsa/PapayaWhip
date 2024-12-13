document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const modalImg = document.getElementById('modal-img');
    const modalTxt = document.getElementById('modal-txt');
    const modalUrl = document.getElementById('modal-url');
    const closeModal = document.getElementById('close-modal');

    document.querySelectorAll('.event').forEach(event => {
        event.addEventListener('click', () => {
            modalImg.src = event.dataset.img;
            modalUrl.href = event.dataset.url;

            const txtFilePath = event.dataset.txt;
            if (txtFilePath) {
                fetch(txtFilePath)
                    .then(response => {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw new Error("Unable to fetch the transcription.");
                        }
                    })
                    .then(text => {
                        modalTxt.textContent = text;
                    })
                    .catch(error => {
                        console.error(error);
                        modalTxt.textContent = "Transcription could not be loaded.";
                    });
            } else {
                modalTxt.textContent = "No transcription available.";
            }

            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});

