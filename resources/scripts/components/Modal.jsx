import React, { Component } from 'react'
import PropTypes from 'prop-types'
import $ from 'jquery'
import star from './../assets/icon-star.svg'
import fork from './../assets/icon-fork.svg'
import code from './../assets/icon-code.svg'
import eye from './../assets/icon-eye.svg'

class Modal extends Component {

  componentDidMount() {
    $('#repo-details').on('hidden.bs.modal', e => {
      this.props.hideDetails.bind(this)
    }).click(e => $(e.target).modal('hide'))
    this.componentDidUpdate()
  }

  componentDidUpdate() {
    $('#repo-details').modal('show')
    $('body').css('padding-right', '')
  }

  render() {
    return (
      <div id="repo-details" className="modal fade" tabIndex="-1" role="dialog" data-backdrop="false">
        <div className="modal-dialog" role="document">
          <div className="modal-content">
            <div className="modal-header text-center d-block">
              <div className="text-right">
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <img src={this.props.repo.avatar} alt="Repository avatar" className="modal-avatar rounded" style={{ height: '140px' }} />
              <h2 className="modal-title">{this.props.repo.name}</h2>
              <small className="modal-author">by {this.props.repo.owner}</small>
            </div>
            <div className="modal-body">
              <p>{this.props.repo.description}</p>
              <div className="d-flex justify-content-around">
                <div className="d-inline border border-success text-success rounded px-2">
                  <img src={star} className="mr-1" alt="Icon for stars count" aria-hidden="true" />
                  {this.props.repo.stars}
                </div>
                <div className="d-inline border border-primary text-primary rounded px-2">
                  <img src={fork} className="mr-1" alt="Icon for forks count" aria-hidden="true" />    
                  {this.props.repo.forks}
                </div>
                <div className="d-inline border border-danger text-danger rounded px-2">
                  <img src={code} className="mr-1" alt="Coding icon" aria-hidden="true" />
                  {this.props.repo.language.name}
                </div>
              </div>
            </div>
            <div className="modal-footer">
              <a href={this.props.repo.url} id="modal-link" className="btn btn-light" target="_blank" rel="noopener noreferrer">
                <img src={eye} alt="View icon" aria-hidden="true" />
                See GitHub repository
              </a>
              <button type="button" className="btn btn-pop" data-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

Modal.propTypes = {
  repo: PropTypes.object.isRequired,
  hideDetails: PropTypes.func.isRequired
}

export default Modal
