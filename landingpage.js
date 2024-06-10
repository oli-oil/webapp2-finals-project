   document.getElementById("actualForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const username = document.getElementById("inputName").value;
        const password = document.getElementById("inputPass").value;

        fetch("https://jsonplaceholder.typicode.com/users")
            .then(response => response.json())
            .then(users => {
                const user = users.find(user => user.username === username);
                
                if (user) {
                    if (password === "asdfghjkl") {
                        window.location.href = "secondpagepost.php";
                    } else {
                        alert("Incorrect Password! Please try again.");
                    }
                } else {
                    alert("User not found! Please try again.");
                }
            })
            .catch(error => alert("Error fetching users:", error));
    });