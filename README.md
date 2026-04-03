🌀 CheckAnime

A Web-Based Anime Registry & Community Platform
📖 Introduction

CheckAnime is a platform designed to provide accessible documentation on high-quality Japanese animated series. The goal is to offer a space where anyone can discover top-rated anime, view detailed statistics, and engage with a community through constructive reviews.

🚀 Key Features

    User Authentication System: Secure registration and login functionality.

    Top-Rated Anime Explorer: A dynamically generated list of anime sorted by rating in descending order.

    Community Reviews: Users can leave reviews for specific series, which are stored and displayed chronologically.

    Dynamic UI Elements: Features an automatic background image slider implemented in JavaScript.

    Detailed Series Information: View specific data for each entry, including production studio, episode count, and release dates.

🛠️ Technical Stack

    Backend: PHP.

    Frontend: HTML, CSS, JavaScript.

    Database: MySQL (phpMyAdmin).

    Framework: Bootstrap CSS.

    Tools: Visual Studio Code, Live Server extension.

🔐 Security & Logic

A core focus of this project was data security and dynamic content management:

    Password Hashing: User passwords are encrypted using the Blowfish algorithm (via the crypt() function) with a 22-character random salt to ensure data protection.

    Relational Database: Uses SQL JOIN operations to connect user profiles with their specific comments on various anime entries.

    Slider Logic: The slider.js handles automatic transitions every 4.8 seconds by toggling CSS display properties.

📊 Database Schema

The project relies on three primary relational tables:
Table	Purpose	Key Columns
ATESTAT	User Management	

ID, Username, Email, Password (hashed)
Animes	Content Library	

ID, Title, Rating, Episodes, Production, Air
Comments	Community Interaction	

ID, user_id, anime_id, Comments, Date
⚙️ Setup & Operating Parameters

    OS: Windows 10 or higher recommended.

    Browser: Optimized for Chrome or Microsoft Edge.

    Environment: Requires a PHP execution environment (e.g., XAMPP or VS Code Live Server).

    Network: Active connection required for database communication.

🔮 Future Development

    Search System: Implementing filters to search by name, genre, or episode count.

    Data Import: Automating database updates via .csv file imports.

    UI/UX Overhaul: Further styling refinements to enhance the thematic immersion for fans.

📚 Bibliography

    Styling: Bootstrap.

    Documentation: W3Schools & MySQL Docs.

    Data Source: MyAnimeList.
