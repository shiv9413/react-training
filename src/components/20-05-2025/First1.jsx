import React from 'react';

// const First1 = ({name}) => <h1>This is first1 and name ,{name}</h1>
// export default First1;

const Card = ({children}) => {
	return <div className="card">{children}</div>
}

export default Card;