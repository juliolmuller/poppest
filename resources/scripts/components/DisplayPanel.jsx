import React, { Component } from 'react'
import Repo from './Repo'
// import Modal from './Modal'
import loading from './../assets/loading.gif'

class DisplayPanel extends Component {

  state = {
    visibleDetails: false,
    detailsFor: {}
  }

  toggleDetails = (repo = {}) => {
    this.setState({
      visibleDetails: !!repo,
      detailsFor: repo
    })
  }

  getDetails = () => {
    if (this.state.visibleDetails) {
      // return <Modal repo={this.state.detailsFor} hideDetails={this.toggleDetails} />
    }
  }

  render() {
    const testing = [
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      },
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      },
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      },
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      },
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      },
      {
        owner: 'Julio Muller',
        name: 'My Repo',
        avatar: loading,
        stars: '1,234',
        forks: '1,234',
        url: 'http://google.com',
        language: { name: 'PHP' }
      }
    ]
    return (
      <div className="content">
        <div className="row">
          {
            testing.map((t, i) => {
              return (
                <Repo
                  key={i}
                  repo={t}
                  showDetails={this.toggleDetails}
                />
              )
            })
          }
        </div>
      {this.getDetails()}
      </div>
    )
  }
}

export default DisplayPanel
