const MODEL_URL = '/ApplicationWeb_GestionPointage/models'
const maxDescriptorDistance = 0.6
const video = document.querySelector('video')
const progress = document.querySelector('progress')
const retry = document.querySelector('#retry')
// const button = document.querySelector('button')
// const nameInput = document.querySelector('input[type=text]')
// const fileInput = document.querySelector('input[type=file]')
let labeledFaceDescriptors = []//,results = null,fullFaceDescriptions=null;

function startRecording(){
    navigator.getUserMedia({video:{}},stream => {video.srcObject = stream;},err=>console.log(err));
}
Promise.all([
    faceapi.loadSsdMobilenetv1Model(MODEL_URL),
    faceapi.loadFaceLandmarkModel(MODEL_URL),
    faceapi.loadFaceRecognitionModel(MODEL_URL),
]).then(()=>{
    progress.classList.add('invisible')
    video.parentElement.classList.remove('invisible')
    video.parentElement.classList.remove('d-none')
    startRecording();
});

let interval;
video.addEventListener('play',()=>{
    saveFaces()
    const canvas = faceapi.createCanvasFromMedia(video)
    document.body.append(canvas)
    const displaySize = {width:video.width,height:video.height}
    faceapi.matchDimensions(canvas,displaySize)
    interval = setInterval(async ()=>{
        let detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors();
        const resizedDetections = faceapi.resizeResults(detections,displaySize);
        canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height)
        canvas.style.position = "fixed";
        canvas.style.left = video.getBoundingClientRect().x.toFixed(1)+"px" ;//.x+'px';
        canvas.style.top = video.getBoundingClientRect().y.toFixed(1)+"px" ;//.y+'px';
        // faceapi.draw.drawDetections(canvas,resizedDetections);
        // console.log(labeledFaceDescriptors.length);
        if(labeledFaceDescriptors.length){
            // console.log('draw landmarks.');
            const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, maxDescriptorDistance)
            const fullFaceDescriptions = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()
            const results = fullFaceDescriptions.map(fd => faceMatcher.findBestMatch(fd.descriptor))
            results.forEach((bestMatch, i) => {
                const box = fullFaceDescriptions[i].detection.box
                // console.log(bestMatch)
                const text = bestMatch.toString()
                const drawBox = new faceapi.draw.DrawBox(box, { label: text })
                // drawBox.draw(canvas)
                // console.log(text)
                empIndex = empList.map(emp=>emp.firstname+" "+emp.lastname).indexOf(bestMatch.label)
                if(empIndex >= 0){
                    // console.log(empList[empIndex])
                    document.querySelector('#emp').value = empList[empIndex].cin
                    clearInterval(interval)
                    canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height)
                    video.parentElement.classList.add('invisible')
                    video.parentElement.classList.add('d-none')
                    video.pause()
                    document.querySelector('input[type="time"]').value = new Date().toTimeString().split(' ')[0]
                    const pointageLogs = pointageList.filter(el=>el.cin === empList[empIndex].cin)
                    console.log(pointageLogs)
                    const maxDate = Math.max(...pointageLogs.map(el=>el.timeStamp))
                    console.log(maxDate)
                    const lastPointage = pointageLogs.find(el=>el.timeStamp === maxDate)
                    console.log(lastPointage)
                    document.querySelector('#type').value = lastPointage.type[0] === "E" ? "Sortie" : "Entrée"
                    canvas.classList.add('invisible')
                    canvas.classList.add('d-none')                    
                    retry.classList.remove('invisible')
                    retry.classList.remove('d-none')
                }
            })
        }
    },100)
})

retry.addEventListener("click",()=>{
    retry.classList.add('invisible')
    retry.classList.add('d-none')
    video.parentElement.classList.remove('invisible')
    video.parentElement.classList.remove('d-none')
    video.play()
    const canvas = document.querySelector('canvas');
    canvas.classList.remove('invisible')
    canvas.classList.remove('d-none')                    

})

function saveFaces(){
    if(empList.length){
        empList.forEach(async emp=>{        
            try{
                //const imgUrl = `${label}.jpg`
                const label = emp.firstname+" "+emp.lastname;            
                const img = await faceapi.fetchImage("images/"+emp.img)
                // console.log(label,img)            
                // detect the face with the highest score in the image and compute it's landmarks and face descriptor
                const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                
                if (!fullFaceDescription) {
                    throw new Error(`no faces detected for ${label}`)
                }                
                const faceDescriptors = [fullFaceDescription.descriptor]
                const faceLabel =  new faceapi.LabeledFaceDescriptors(label, faceDescriptors)
                labeledFaceDescriptors.push(faceLabel);
                // showAlert('.alert-success',2000)
            }catch(e){
                console.log(e);
                // showAlert('.alert-danger',2000)
            }
        })        
    }
}