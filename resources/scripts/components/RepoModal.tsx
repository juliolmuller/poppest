import React, { FC, useEffect } from 'react'
import $ from 'jquery'
import { Repository } from '../@types/models'
import star from '../assets/icon-star.svg'
import fork from '../assets/icon-fork.svg'
import code from '../assets/icon-code.svg'
import eye from '../assets/icon-eye.svg'

const REPO_SELECTOR = '#repo-details'

interface RepoModalProps {
  hideDetails: () => void
  repo: Repository
}

const RepoModal: FC<RepoModalProps> = ({ repo, hideDetails }) => {
  useEffect(() => {
    $(REPO_SELECTOR).modal('show')
    $(document.body).css({
      overflow: 'auto',
      paddingRight: 0,
    })
  }, [])

  useEffect(() => {
    $(REPO_SELECTOR).on('hidden.bs.modal', () => {
      hideDetails()
    })
  }, [hideDetails])

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

export default RepoModal
