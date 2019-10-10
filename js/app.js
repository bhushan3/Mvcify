function sendHttpRequest( method, url, data ) {
    return new Promise( function( resolve, reject ) {
        var xhr = new XMLHttpRequest();
        xhr.open( method, url );
        xhr.responseType = 'json';
        xhr.onload = function() {
            if ( xhr.status >= 400 ) {
                reject( xhr.response );
            } else {
                resolve( xhr.response );
            }
        };
        xhr.onerror = function() {
            reject( 'Something went wrong with the XMLHttpRequest' );
        }
        xhr.send( data );
    });
}

document.getElementById( 'form-add-new-user' ) && document.getElementById( 'form-add-new-user' ).addEventListener( 'submit', function( event ) {
    event.preventDefault();
    sendHttpRequest(
        event.target.getAttribute( 'method' ),
        event.target.getAttribute( 'action' ),
        new FormData( event.target )
    )
    .then( function( response ) {
        if ( response.success ) {
            var tr = document.createElement( 'tr' );
            tr.innerHTML = `<td>${response.data.id}</td>
                <td>${response.data.name}</td>
                <td>${response.data.password}</td>
                <td>${response.data.email}</td>
                <td><a href="${siteUrl}/users/deleteuser/${response.data.id}">delete</a></td>
                <td><a href="${siteUrl}/users/edituser/${response.data.id}">edit</a></td>`;
            document.querySelector( '#table-users tbody' ).appendChild( tr );
        }
    })
    .catch( function( error ) {
        console.log( 'ERROR:', error );
    });
});

document.getElementById( 'form-edit-user' ) && document.getElementById( 'form-edit-user' ).addEventListener( 'submit', function( event ) {
    event.preventDefault();
    sendHttpRequest(
        event.target.getAttribute( 'method' ),
        event.target.getAttribute( 'action' ),
        new FormData( event.target )
    )
    .then( function( response ) {
        if ( response.success && response.redirect ) {
            window.location.href = response.redirect;
        }
    })
    .catch( function( error ) {
        console.log( 'ERROR:', error );
    });
});
