
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector('form');
  const username = form.querySelector('input[name="username"]');
  const password = form.querySelector('input[name="password"]');

  form.addEventListener("submit", function (e) {
    let errors = [];

    const validPattern = /^[a-zA-Z0-9_]+$/; 

    if (username.value.trim() === "") {
      errors.push("Username is required.");
    } else if (!validPattern.test(username.value)) {
      errors.push("Username must contain only letters, numbers, or underscores.");
    }

    if (password.value.trim() === "") {
      errors.push("Password is required.");
    } else if (!validPattern.test(password.value)) {
      errors.push("Password must contain only letters, numbers, or underscores.");
    }

    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join("\n")); 
    }
  });
});
