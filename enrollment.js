// Simulated user enrollment data (can be retrieved dynamically from a server)
const enrolledCourses = [];

// Function to enroll in a course
function enroll(courseId) {
    const courseElement = document.getElementById(courseId);

    // Check if already enrolled
    if (enrolledCourses.includes(courseId)) {
        alert("You are already enrolled in this course.");
    } else {
        // Add the course to enrolledCourses
        enrolledCourses.push(courseId);

        // Notify the user
        alert(`Enrolled in ${courseId}`);

        // Optionally, update UI to indicate enrollment (e.g., change button color)
        courseElement.querySelector('button').style.backgroundColor = '#42a642';
        courseElement.querySelector('button').innerText = 'Enrolled';
        courseElement.querySelector('button').disabled = true;
    }
}
