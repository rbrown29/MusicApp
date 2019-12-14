import React, { Component } from 'react';

class Songs extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <tr>
              <td>{this.props.songs.song}</td>
              <td>{this.props.songs.artist}</td>
              <td>{this.props.songs.album}</td>
              <td><img className='covers' src={this.props.songs.cover}/></td>
            </tr>
        );
    }
}

export default Songs;
