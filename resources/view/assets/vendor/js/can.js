const openCameraButton = document.getElementById("openCameraButton");
const cameraModal = document.getElementById("cameraModal");
const cameraView = document.getElementById("cameraView");
const captureButton = document.getElementById("captureButton");
const photoInput = document.getElementById("photo");
const photoPreview = document.getElementById("photoPreview");
const capturedImage = document.getElementById("capturedImage");

openCameraButton.addEventListener("click", () => {
  cameraModal.style.display = "block";

  // Iniciar a câmera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      cameraView.srcObject = stream;
    })
    .catch((error) => {
      console.error("Erro ao acessar a câmera: " + error);
    });
});

captureButton.addEventListener("click", () => {
  // Capturar a foto da câmera como Base64
  const canvas = document.createElement("canvas");
  canvas.width = cameraView.videoWidth;
  canvas.height = cameraView.videoHeight;
  canvas.getContext("2d").drawImage(cameraView, 0, 0, canvas.width, canvas.height);
  const photoData = canvas.toDataURL("image/jpeg");

  // Inclua a imagem Base64 no campo oculto 'photo'
  photoInput.value = photoData;

  // Exibir a imagem capturada no formulário
  capturedImage.src = photoData;
  photoPreview.style.display = "block";

  // Parar a câmera e fechar o modal
  if (cameraView.srcObject) {
    cameraView.srcObject.getTracks()[0].stop();
  }
  cameraModal.style.display = "none";
});


const closeCameraButton = document.getElementById("closeCameraButton");

closeCameraButton.addEventListener("click", () => {
  // Parar a câmera e fechar o modal
  if (cameraView.srcObject) {
    cameraView.srcObject.getTracks()[0].stop();
  }
  cameraModal.style.display = "none";
});
