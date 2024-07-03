const firebaseConfig = {
    apiKey: "AIzaSyDplPVel5ucRFngA5wEKJ9cfwdarEI-q3s",
    authDomain: "leap-41654.firebaseapp.com",
    databaseURL: "https://leap-41654-default-rtdb.firebaseio.com",
    projectId: "leap-41654",
    storageBucket: "leap-41654.appspot.com",
    messagingSenderId: "290852953935",
    appId: "1:290852953935:web:e2e1e59b3aa31e72c06f3a"
};

firebase.initializeApp(firebaseConfig);

const db = firebase.database();
console.log(db);

var sid = $("#sid").val().trim();
var cid = $("#cid").val().trim();
var msg = $("#content").val().trim();

function sendMessage(e) {
    e.preventDefault();

    // get values to be submitted
    const time = Date.now();

    // clear the input box
    var f = document.getElementById('content');
    f.value = "";

    //auto scroll to bottom
    document
        .getElementById("check-box")
        .scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });

    // create db collection and send in the data
    db.ref("messages/" + timestamp).set({
        sid,
        cid,
        msg,
    });


    const fetchChat = db.ref("messages/");

    fetchChat.on("child_added", function (snapshot) {
        const messages = snapshot.val();
        const message = `<li class=${username === messages.username ? "sent" : "receive"
            }><span>${messages.username}: </span>${messages.message}</li>`;
        // append the message on the page
        document.getElementById("check-box").innerHTML += message;
    });
}