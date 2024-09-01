import React from 'react';

function Logout() {
    const handleLogout = async () => {
        try {
            const response = await fetch('http://localhost/server/logout', {
                method: 'POST',
            });
            const data = await response.json();
            console.log(data);
            // Supprimer les informations de l'utilisateur du contexte ou du local storage
        } catch (error) {
            console.error('Error:', error);
        }
    };

    return (
        <button onClick={handleLogout}>Logout</button>
    );
}

export default Logout;
