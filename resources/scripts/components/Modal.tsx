import React, { useEffect } from 'react'
import $ from 'jquery'
import star from '../assets/icon-star.svg'
import fork from '../assets/icon-fork.svg'
import code from '../assets/icon-code.svg'
import eye from '../assets/icon-eye.svg'

interface ModalProps {
  hideDetails: () => void
  repo: Repository
}

const Modal: React.FC<ModalProps> = ({ hideDetails, repo }) => {
  useEffect(() => {
    $('#repo-details').on('hidden.bs.modal', e => {
      hideDetails()
    }).click((ev: any) => $(ev.target).modal('hide'))
    $('#repo-details').modal('show')
    $('body').css({
      'padding-right': '',
      'overflow': 'auto'
    })
  }, [])

  return (
    <div id="repo-details" className="modal fade" tabIndex={-1} role="dialog" data-backdrop="false">
      <div className="modal-dialog" role="document">
        <div className="modal-content">
          <div className="modal-header text-center d-block">
            <div className="text-right">
              <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
              </button>
            </div>
            <img src={repo.avatar} alt="Repository avatar" className="modal-avatar rounded" style={{ height: '140px' }} />
            <h2 className="modal-title">{repo.name}</h2>
            <small className="modal-author">by {repo.owner}</small>
          </div>
          <div className="modal-body">
            <p>{repo.description}</p>
            <div className="d-flex justify-content-around">
              <div className="d-inline border border-success text-success rounded px-2">
                <img src={star} className="mr-1" alt="Icon for stars count" />
                {repo.stars}
              </div>
              <div className="d-inline border border-primary text-primary rounded px-2">
                <img src={fork} className="mr-1" alt="Icon for forks count" />
                {repo.forks}
              </div>
              <div className="d-inline border border-danger text-danger rounded px-2">
                <img src={code} className="mr-1" alt="Coding icon" />
                {repo.language.name}
              </div>
            </div>
          </div>
          <div className="modal-footer">
            <a href={repo.url} id="modal-link" className="btn btn-light" target="_blank" rel="noopener noreferrer">
              <img src={eye} alt="View icon" />
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

export default Modal
